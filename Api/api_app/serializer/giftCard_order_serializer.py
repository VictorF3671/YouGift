from ..models import GiftCardOrder
from rest_framework import serializers
from ..serializer import UserSerializer

class GiftCardOrderSerializer(serializers.ModelSerializer):
    user = UserSerializer(read_only=True)
    
    class Meta:
        model = GiftCardOrder
        fields = ['user','is_paid','total','created_at','status']