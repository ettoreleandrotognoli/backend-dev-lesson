from django.conf.urls import url,include
from django.contrib import admin

from views import *

urlpatterns = [
    url(r'^preview/(?P<code>[a-zA-Z0-9]+)/',show_view,name='url-preview'),
    url(r'^(?P<code>[a-zA-Z0-9]+)/',redirect_view,name='url-redirect'),
    url(r'^$',ShortUrlCreateView.as_view(),name='url-create'),
]