import random
import string


def gerar_codigo_unico(tamanho):
    from .models import GiftCardSerial
    
    caracteres = string.ascii_uppercase + string.digits
    while True:
        codigo = ''.join(random.choices(caracteres, k=tamanho))
        if not GiftCardSerial.objects.filter(code = codigo).exists():
            return codigo
    