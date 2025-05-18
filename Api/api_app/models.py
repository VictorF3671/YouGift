from django.db import models

# Create your models here.

class UserGroup(models.Model):
    access_level = models.CharField(max_length=100)

    def __str__(self):
        return self.access_level
  
    
class User(models.Model):
    cpf = models.CharField(max_length=11, unique=True)
    fullname = models.CharField(max_length=255)
    email = models.EmailField(unique=True)
    password_hash = models.CharField(max_length=255)
    username = models.CharField(max_length=100, blank=True)
    phone_number = models.CharField(max_length=11)
    created_at = models.DateTimeField(auto_now_add=True)
    group = models.ForeignKey(UserGroup, on_delete=models.CASCADE, related_name='users')
    
    class Meta:
        ordering = ["fullname"]
        verbose_name = 'User'
        verbose_name_plural = 'Users'

    def __str__(self):
        return self.fullname
      
        
class BankAccount(models.Model):
    CARD_TYPES = (
        ("credit", "Cartão de Crédito"),
        ("debit", "Cartão de Débito"),
    )

    user = models.ForeignKey(User, on_delete=models.CASCADE, related_name='bank_accounts')
    cvv_encrypted = models.TextField()
    card_number_encrypted = models.TextField()
    card_holder_name = models.CharField(max_length=255)
    card_type = models.CharField(max_length=10, choices=CARD_TYPES)
    expiration_date = models.DateField()
    created_at = models.DateTimeField(auto_now_add=True)

    class Meta:
        ordering = ["card_holder_name"]
        verbose_name = 'Bank Account'
        verbose_name_plural = 'Bank Accounts'
     
    
class GiftCard(models.Model):
    name = models.CharField(max_length=255)
    desc = models.TextField()
    image_url = models.URLField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)
    company = models.CharField(max_length=255)

    class Meta:
        ordering = ["name"]
        verbose_name = 'Gift Card'
        verbose_name_plural = 'Gift Cards'

    def __str__(self):
        return self.name


class GiftCardValue(models.Model):
    gift_card = models.ForeignKey(GiftCard, on_delete=models.CASCADE, related_name="values")
    value = models.DecimalField(max_digits=10, decimal_places=2)
    created_at = models.DateTimeField(auto_now_add=True)

    class Meta:
        ordering = ["value"]
        verbose_name = 'Gift Card Value'
        verbose_name_plural = 'Gift Card Values'


class GiftCardOrder(models.Model):
    STATUS_CHOICES = [
        ("pending", "Aguardando Pagamento"),
        ("paid", "Pago"),
        ("cancelled", "Cancelado"),
    ]
    
    user = models.ForeignKey(User, on_delete=models.CASCADE, related_name='orders')
    is_paid = models.BooleanField(default=False)
    total = models.DecimalField(max_digits=10, decimal_places=2, default=0)
    created_at = models.DateTimeField(auto_now_add=True)
    status = models.CharField(max_length=20, choices=STATUS_CHOICES, default="pending")

    class Meta:
        ordering = ['id']
        verbose_name = 'Gift Card Order'
        verbose_name_plural = 'Gift Card Orders'
    
    
class GiftCardOrderItem(models.Model):
    order = models.ForeignKey(GiftCardOrder, on_delete=models.CASCADE, related_name='items')
    gift_card = models.ForeignKey(GiftCard, on_delete=models.CASCADE, related_name='order_items')
    quantity = models.PositiveIntegerField()

    class Meta:
        ordering = ["id"]
        verbose_name = 'Gift Card Order Item'
        verbose_name_plural = 'Gift Card Order Items'
        

class GiftCardSerial(models.Model):
    gift_card = models.ForeignKey(GiftCard, on_delete=models.CASCADE, related_name="serials")
    user = models.ForeignKey(User, on_delete=models.CASCADE, related_name='giftcard_serials')
    order_item = models.ForeignKey(GiftCardOrderItem, on_delete=models.CASCADE, related_name='serials')
    code = models.CharField(max_length=16, unique=True, blank=True)
    created_at = models.DateTimeField(auto_now_add=True)

    def save(self, *args, **kwargs):
        if not self.code:
            from .utils import gerar_codigo_unico
            self.code = gerar_codigo_unico(16)
        super().save(*args, **kwargs)

    class Meta:
        ordering = ["code"]
        verbose_name = 'Gift Card Serial'
        verbose_name_plural = 'Gift Card Serials'

class SaleHistory(models.Model):
    PAYMENT_METHODS = (
        ("credit", "Cartão de Crédito"),
        ("debit", "Cartão de Débito"),
        ("pix", "Pix"),
    )

    order = models.OneToOneField(GiftCardOrder, on_delete=models.CASCADE, related_name='sale_history')
    user = models.ForeignKey(User, on_delete=models.CASCADE, related_name='sale_history')
    bank_account = models.ForeignKey(BankAccount, on_delete=models.SET_NULL, null=True, blank=True, related_name='sale_history')
    payment_method = models.CharField(max_length=10, choices=PAYMENT_METHODS, default="credit")
    transaction_code = models.CharField(max_length=100, blank=True, null=True)
    is_confirmed = models.BooleanField(default=False)
    created_at = models.DateTimeField(auto_now_add=True)

    class Meta:
        ordering = ['-created_at']
        verbose_name = 'Sale History'
        verbose_name_plural = 'Sale Histories'