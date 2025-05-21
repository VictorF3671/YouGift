from rest_framework import viewsets
from ..models import UserGroup
from ..serializer.userGroup_serializer import UserGroupSerializer

class UserGroupViewSet(viewsets.ModelViewSet):
    queryset = UserGroup.objects.all()
    serializer_class = UserGroupSerializer
