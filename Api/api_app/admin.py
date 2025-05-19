from django.contrib import admin
from .models import UserGroup,User,BankAccount,GiftCardValue,GiftCard,GiftCardOrder,GiftCardOrderItem,GiftCardSerial

# Register your models here.
admin.site.register(UserGroup)
admin.site.register(User)
admin.site.register(BankAccount)
admin.site.register(GiftCardSerial)
admin.site.register(GiftCardOrder)
admin.site.register(GiftCardValue)
admin.site.register(GiftCard)
admin.site.register(GiftCardOrderItem)