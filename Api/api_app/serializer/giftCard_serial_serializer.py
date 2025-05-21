from ..models import GiftCardSerial
from rest_framework import serializers
from ..serializer.user_serializer import UserSerializer
from ..serializer.giftCard_serializer import GiftCardSerializer
from ..serializer.giftCard_order_item_serializer import GiftCardOrderItemSerializer

class GiftCardSerialSerializer(serializers.ModelSerializer):
    gift_card = GiftCardSerializer(read_only=True)
    user = UserSerializer(read_only=True)
    order_item = GiftCardOrderItemSerializer(read_only=True)
    
    class Meta:
        model = GiftCardSerial
        fields=['gift_card','user','order_item','code','created_at']