from django.db import models
from django.contrib.auth.models import AbstractUser, BaseUserManager, PermissionsMixin

# Create your models here.

class UserGroup(models.Model):
    access_level = models.CharField(max_length=100)

    def __str__(self):
        return self.access_level
  
class UserManager(BaseUserManager):
    def create_user(self, email, password=None, **extra_fields):
        if not email:
            raise ValueError("O email é obrigatório")
        email = self.normalize_email(email)
        user = self.model(email=email, **extra_fields)
        user.set_password(password)
        user.save()
        return user

    def create_superuser(self, email, password=None, **extra_fields):
        extra_fields.setdefault("is_staff", True)
        extra_fields.setdefault("is_superuser", True)
        extra_fields.setdefault("group_id", 1)
        return self.create_user(email, password, **extra_fields)
       
class User(AbstractUser):
    email = models.EmailField(unique=True)
    cpf = models.CharField(max_length=11, unique=True)
    fullname = models.CharField(max_length=255)
    phone_number = models.CharField(max_length=11)
    group = models.ForeignKey('UserGroup', on_delete=models.CASCADE, related_name='users')
    is_active = models.BooleanField(default=True)
    is_staff = models.BooleanField(default=False)
    created_at = models.DateTimeField(auto_now_add=True)

    objects = UserManager()

    USERNAME_FIELD = 'email'
    REQUIRED_FIELDS = ['fullname']

    def __str__(self):
        return self.email
    
    
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


class GiftCardSerial(models.Model):
    gift_card = models.ForeignKey(GiftCard, on_delete=models.CASCADE, related_name="serials")
    user = models.ForeignKey(User, on_delete=models.CASCADE, related_name='giftcard_serials')
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