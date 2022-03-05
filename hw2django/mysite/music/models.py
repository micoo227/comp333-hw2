from django.db import models

# Create your models here.
class users(models.Model):
    username = models.CharField(max_length=255)
    password = models.CharField(max_length=255)

class ratings(models.Model):
    username = models.ForeignKey(users, on_delete=models.CASCADE)
    song = models.CharField(max_length=255)
    rating = models.IntegerField()