from ..models import GiftCardValue
from rest_framework import serializers

class GiftCardValueSerializer(serializers.ModelSerializer):
    class Meta:
        model = GiftCardValue
        fields = ['id', 'gift_card', 'value', 'created_at']
        read_only_fields = ['id', 'created_at']