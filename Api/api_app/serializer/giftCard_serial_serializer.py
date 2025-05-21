from ..models import GiftCardSerial,User,GiftCardValue
from rest_framework import serializers

class GiftCardSerialSerializer(serializers.ModelSerializer):
    gift_card_value_id = serializers.PrimaryKeyRelatedField(
        queryset=GiftCardValue.objects.all(), write_only=True
    )
    user = serializers.PrimaryKeyRelatedField(queryset=User.objects.all())

    class Meta:
        model = GiftCardSerial
        fields = ['gift_card_value_id', 'user']

    def validate(self, data):
        # Garante que está pegando a instância correta
        gift_card_value = data['gift_card_value_id']
        if not gift_card_value:
            raise serializers.ValidationError("O valor do gift card é obrigatório.")
        return data

    def create(self, validated_data):
        gift_card_value = validated_data.pop('gift_card_value_id')
        user = validated_data['user']
        
        # Criar o serial vinculado ao GiftCard via gift_card_value.gift_card
        return GiftCardSerial.objects.create(
            gift_card=gift_card_value.gift_card,
            user=user
        )