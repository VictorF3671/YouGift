from ..models import GiftCardOrder
from rest_framework import serializers
from ..serializer.giftCard_order_item_serializer import GiftCardOrderItemSerializer
from ..models import GiftCardOrderItem

class GiftCardOrderCreateSerializer(serializers.ModelSerializer):
    items = GiftCardOrderItemSerializer(many=True)

    class Meta:
        model = GiftCardOrder
        fields = ['id', 'user', 'items', 'total', 'is_paid', 'status', 'created_at']
        read_only_fields = ['id', 'total', 'is_paid', 'status', 'created_at']

    def create(self, validated_data):
        from decimal import Decimal
        from django.db import transaction
        from api_app.models import GiftCardValue

        items_data = validated_data.pop('items')
        total = Decimal('0.00')

        with transaction.atomic():
            order = GiftCardOrder.objects.create(**validated_data)

            for item in items_data:
                gift_card = item['gift_card']
                value_id = item["gift_card_value"]
                if not value_id:
                    raise serializers.ValidationError("gift_card_value é obrigatório")
                quantity = item['quantity']

                try:
                    gift_card_value = value_id
                except GiftCardValue.DoesNotExist:
                    raise serializers.ValidationError(
                        f"O valor selecionado não pertence ao GiftCard '{gift_card.name}'"
                    )

                subtotal = gift_card_value.value * quantity

                GiftCardOrderItem.objects.create(
                    order=order,
                    gift_card=gift_card,
                    quantity=quantity
                )

                total += subtotal

            order.total = total
            order.save()
        return order
