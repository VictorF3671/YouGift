from ..models import GiftCardValue
from rest_framework import serializers

class GiftCardValueSerializer(serializers.ModelSerializer):
    class Meta:
        model = GiftCardValue
        fields = '__all__'