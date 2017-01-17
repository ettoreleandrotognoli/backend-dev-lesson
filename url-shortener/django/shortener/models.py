# -*- encoding: utf-8 -*-
from __future__ import unicode_literals
from django.utils.translation import ugettext_lazy as _

from django.db import models
from django.db.models.functions import Coalesce
from numpy import base_repr


class ShortUrlQuerySet(models.QuerySet):
    
    def next_pk(self):
        print 'excute'
        query = ShortUrl.objects.aggregate(
            id__max=Coalesce(models.Max('id'),0,output_field=models.IntegerField())
        )
        return query['id__max'] + 1

class ShortUrl(models.Model):

    class Meta:
        verbose_name = _('URL Encurtada')
        verbose_name_plural = _('URLs Encurtadas')

    objects = ShortUrlQuerySet().as_manager()

    created = models.DateTimeField(
        auto_now_add=True,
        verbose_name=_('Data de Criação'),
    )

    updated = models.DateTimeField(
        auto_now=True,
        verbose_name=_('Data de Atualização'),
    )

    url = models.URLField(
        db_index=True,
        verbose_name=_('URL'),
    )

    code = models.CharField(
        max_length=255,
        db_index=True,
        verbose_name=_('Código'),
        blank=True,
        null=True,
    )

    def save(self,*args,**kwargs):
        if self.pk or self.code:
            return super(ShortUrl,self).save(*args,**kwargs)
        self.make_code()
        return super(ShortUrl,self).save(*args,**kwargs)

    def make_code(self):
        pk = self.pk if self.pk else ShortUrl.objects.next_pk()
        self.code = base_repr(pk,36)

    def get_absolute_url(self):
        return self.url

    def __str__(self):
        return self.url