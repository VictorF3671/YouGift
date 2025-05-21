# urls.py
from rest_framework.routers import DefaultRouter

from .view.giftCard_order_viewset import GiftCardOrderViewSet
from .view.usergroup_viewset import UserGroupViewSet
from .view.user_viewset import UserViewSet
from .view.giftCard_value_viewset import GiftCardValueViewSet
from .view.giftCard_viewset import GiftCardViewSet

router = DefaultRouter()
router.register(r'giftcards', GiftCardViewSet)
router.register(r'giftcard-values', GiftCardValueViewSet, basename='giftcard-value')
router.register(r'users', UserViewSet, basename='user')
router.register(r'groups', UserGroupViewSet, basename='usergroup')
router.register(r'giftcard-orders', GiftCardOrderViewSet, basename='giftcard-order')

urlpatterns = router.urls