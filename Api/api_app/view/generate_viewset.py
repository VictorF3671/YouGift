from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework import generics
from ..serializer.giftCard_serial_serializer import GiftCardSerialSerializer

class GerarGiftCardSerialView(generics.CreateAPIView):
    serializer_class = GiftCardSerialSerializer

    def perform_create(self, serializer):
        serializer.save()  # o código será gerado automat