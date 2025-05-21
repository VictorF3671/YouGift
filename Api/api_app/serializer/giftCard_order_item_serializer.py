from ..models import GiftCard, GiftCardValue
from rest_framework import serializers


class GiftCardOrderItemSerializer(serializers.Serializer):
    gift_card = serializers.PrimaryKeyRelatedField(queryset=GiftCard.objects.all())
    gift_card_value = serializers.PrimaryKeyRelatedField(queryset=GiftCardValue.objects.all())
    quantity = serializers.IntegerField(min_value=1)