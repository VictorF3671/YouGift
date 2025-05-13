from django.db import models

# Create your models here.
class GiftCard(models.Model):
    name = models.CharField(max_length=100)
    description = models.CharField(max_length=255)
    image = models.CharField(max_length=255)
    quantity = models.IntegerField()
    
    def __str__(self):
        return self.name
    
class giftCard_serializer(models.Model):
    giftcard = models.ForeignKey(GiftCard, on_delete=models.CASCADE)
    code = models.CharField(max_length=100)
    is_used = models.BooleanField(default=False)
    in_date = models.DateTimeField(auto_now_add=True)
    
    def __str__(self):
        return self.giftcard.name