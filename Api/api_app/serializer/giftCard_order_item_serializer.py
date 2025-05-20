from ..models import GiftCardOrderItem
from rest_framework import serializers
from ..serializer import GiftCardSerializer,GiftCardOrderSerializer


class GiftCardOrderItemSerializer(serializers.ModelSerializer):
    order = GiftCardOrderSerializer(read_only=True)
    gift_card = GiftCardSerializer(read_only=True)
    
    class Meta:
        model = GiftCardOrderItem
        fields = ['order', 'gift_card','quantity']