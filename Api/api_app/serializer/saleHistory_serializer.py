from ..models import SaleHistory
from rest_framework import serializers
from ..serializer import GiftCardOrderSerializer, UserSerializer

class SaleHistorySerializer(serializers.ModelSerializer):
    order = GiftCardOrderSerializer(read_only=True)
    user = UserSerializer(read_only=True)
    
    class Meta:
        model = SaleHistory
        fields=['order','user', 'payment_method', 'transaction_code', 'is_confirmed', 'created_at']