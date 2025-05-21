from django.contrib import admin
from .models import UserGroup,User,GiftCardValue,GiftCard,GiftCardSerial

# Register your models here.
admin.site.register(UserGroup)
admin.site.register(User)
admin.site.register(GiftCardSerial)
admin.site.register(GiftCardValue)
admin.site.register(GiftCard)