from ..models import GiftCardSerial
from rest_framework import serializers
from ..serializer import UserSerializer,GiftCardSerializer,GiftCardOrderItemSerializer

class GiftCardSerialSerializer(serializers.ModelSerializer):
    gift_card = GiftCardSerializer(read_only=True)
    user = UserSerializer(read_only=True)
    order_item = GiftCardOrderItemSerializer(read_only=True)
    
    class Meta:
        model = GiftCardSerial
        fields=['gift_card','user','order_item','code','created_at']