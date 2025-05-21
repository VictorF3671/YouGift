# urls.py
from django.urls import path
from rest_framework.routers import DefaultRouter
from .view.usergroup_viewset import UserGroupViewSet
from .view.user_viewset import UserViewSet
from .view.giftCard_value_viewset import GiftCardValueViewSet
from .view.giftCard_viewset import GiftCardViewSet
from .view.generate_viewset import GerarGiftCardSerialView

router = DefaultRouter()
router.register(r'giftcards', GiftCardViewSet)
router.register(r'giftcard-values', GiftCardValueViewSet, basename='giftcard-value')
router.register(r'users', UserViewSet, basename='user')
router.register(r'groups', UserGroupViewSet, basename='usergroup')

urlpatterns = [
    path("gerar-giftcard-serial/", GerarGiftCardSerialView.as_view(), name="gerar_giftcard_serial"),
]

urlpatterns += router.urls