from rest_framework import viewsets
from ..models import User
from ..serializer.user_serializer import UserCreateSerializer

class UserViewSet(viewsets.ModelViewSet):
    queryset = User.objects.all()
    serializer_class = UserCreateSerializer
