from ..models import GiftCardValue
from rest_framework import serializers
from ..serializer import GiftCardSerializer

class GiftCardValueSerializer(serializers.ModelSerializer):
    gift_card = GiftCardSerializer(read_only=True)
    
    class Meta:
        model = GiftCardValue
        fields = ['gift_card','value','created_at']