from ..models import User
from ..serializer import UserGroupSerializer
from rest_framework import serializers

class UserSerializer(serializers.ModelSerializer):
    group = UserGroupSerializer(read_only=True)
    
    class Meta:
        model = User
        fields = ['id', 'fullname', 'email', 'created_at', 'group'] 