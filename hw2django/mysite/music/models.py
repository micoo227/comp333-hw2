from django.db import models

# Create your models here.
class user(models.Model):
    username = models.CharField(max_length=255, primary_key=True, unique=True,null=False)
    password = models.CharField(max_length=255)

    def __str__(self):
        return self.username

class artist(models.Model):
    song = models.CharField(max_length=255, primary_key=True)
    artist = models.CharField(max_length=255)

    def __str__(self):
        return str(self.song)

class rating(models.Model):
    username = models.ForeignKey(user, on_delete=models.CASCADE)
    song = models.ForeignKey(artist, on_delete=models.CASCADE)
    rating = models.IntegerField(default=0)

    def __str__(self):
        return str(self.song) + " --> " + str(self.rating) 


