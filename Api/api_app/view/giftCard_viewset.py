from rest_framework import viewsets
from ..models import GiftCard
from ..serializer.giftCard_serializer import GiftCardSerializer

class GiftCardViewSet(viewsets.ModelViewSet):
    queryset = GiftCard.objects.all()
    serializer_class = GiftCardSerializer