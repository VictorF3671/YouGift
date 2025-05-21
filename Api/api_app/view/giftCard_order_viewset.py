from rest_framework.decorators import action
from rest_framework.response import Response
from rest_framework import viewsets
from django.utils import timezone
from ..serializer.giftCard_order_serializer import GiftCardOrderCreateSerializer

from ..models import (
    GiftCardOrder,
    GiftCardSerial,
    SaleHistory,
)


class GiftCardOrderViewSet(viewsets.ModelViewSet):
    queryset = GiftCardOrder.objects.all()
    serializer_class = GiftCardOrderCreateSerializer