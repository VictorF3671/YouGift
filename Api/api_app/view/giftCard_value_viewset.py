from rest_framework import viewsets
from ..models import GiftCardValue
from ..serializer.giftCard_value_serializer import GiftCardValueSerializer

class GiftCardValueViewSet(viewsets.ModelViewSet):
    queryset = GiftCardValue.objects.all()
    serializer_class = GiftCardValueSerializer