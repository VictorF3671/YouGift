import uuid
from django.db import models

class GiftCard(models.Model):
    empresa = models.CharField(max_length=100)
    valor = models.DecimalField(max_digits=10, decimal_places=2)
    codigo = models.CharField(max_length=12, blank=True, null=True)
    descricao = models.TextField(blank=True)
    isBuy = models.BooleanField(default=False)

    def save(self, *args, **kwargs):
        if self.isBuy and not self.codigo:
            self.codigo = self.gerar_codigo()
        super().save(*args, **kwargs)

    def gerar_codigo(self):
        return str(uuid.uuid4()).replace("-", "")[:12].upper()
