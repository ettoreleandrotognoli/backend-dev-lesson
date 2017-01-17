# -*- encoding: utf-8 -*-
from __future__ import unicode_literals

from django.apps import AppConfig
from django.utils.translation import ugettext_lazy as _


class ShortenerConfig(AppConfig):
    name = 'shortener'
    verbose_name = _('Encurtador de URLs')
