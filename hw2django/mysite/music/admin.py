from django.contrib import admin
from .models import user, artist, rating
# Register your models here.

admin.site.register(user)
admin.site.register(artist)
admin.site.register(rating)