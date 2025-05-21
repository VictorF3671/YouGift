from rest_framework import serializers
from ..serializer.giftCard_value_serializer import GiftCardValueSerializer
from ..models import GiftCard

class GiftCardSerializer(serializers.ModelSerializer):
    values = GiftCardValueSerializer(many=True, read_only=True)

    class Meta:
        model = GiftCard
        fields = ['id', 'name', 'desc', 'image_url', 'company', 'created_at', 'values']