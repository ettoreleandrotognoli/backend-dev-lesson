from django.contrib import admin

from .models import ShortUrl

@admin.register(ShortUrl)
class ShortUrlAdmin(admin.ModelAdmin):
    pass
