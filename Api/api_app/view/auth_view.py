from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework import status
from django.conf import settings
from ..models import User
from ..serializer.auth_serializer import LoginSerializer
import jwt
from drf_yasg import openapi

from drf_yasg.utils import swagger_auto_schema


class LoginView(APIView):
    @swagger_auto_schema(
        request_body=LoginSerializer,
        responses={200: openapi.Response("Token JWT gerado")}
    )
    def post(self, request):
        serializer = LoginSerializer(data=request.data)
        serializer.is_valid(raise_exception=True)

        email = serializer.validated_data["email"]
        password = serializer.validated_data["password"]

        try:
            user = User.objects.get(email=email)
            if not user.check_password(password):
                return Response({"detail": "Senha inválida"}, status=status.HTTP_401_UNAUTHORIZED)

            token = jwt.encode(
                {"user_id": user.id, "email": user.email},
                settings.SECRET_KEY,
                algorithm="HS256",
            )
            return Response({"token": token})

        except User.DoesNotExist:
            return Response({"detail": "Usuário não encontrado"}, status=status.HTTP_404_NOT_FOUND)
