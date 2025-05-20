from rest_framework import serializers
from ..serializer import GiftCardValueSerializer
from ..models import GiftCard

class GiftCardSerializer(serializers.ModelSerializer):
    value = GiftCardValueSerializer(read_only=True)
    
    class Meta:
        model = GiftCard
        fields = ['name','desc','create_at','company','value']