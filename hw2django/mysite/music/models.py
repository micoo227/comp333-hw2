from django.db import models

# Create your models here.
class User(models.Model):
    username = models.CharField(max_length=255, primary_key=True, unique=True,null=False)
    password = models.CharField(max_length=255)

    def __str__(self):
        return self.username

class Artist(models.Model):
    song = models.CharField(max_length=255, primary_key=True)
    artist = models.CharField(max_length=255)

    def __str__(self):
        return str(self.song)

class Rating(models.Model):
    username = models.ForeignKey(User, on_delete=models.CASCADE)
    song = models.ForeignKey(Artist, on_delete=models.CASCADE)
    rating = models.IntegerField(default=0)

    def __str__(self):
        return str(self.song) + " --> " + str(self.rating) 


