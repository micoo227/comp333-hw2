from django.db import models

# Create your models here.
class User(models.Model):
    username = models.CharField(max_length=255, primary_key=True, unique=True,null=False)
    password = models.CharField(max_length=255)

    def __str__(self):
        return self.username

class Biography(models.Model):
    artist = models.CharField(max_length=255, primary_key=True)
    birthplace = models.CharField(max_length=255)
    birthday = models.DateField()

    def __str__(self):
        return self.artist

    def print_facts(self):
        birthplace = str(self.artist) + "'s " + "Birthplace: " + str(self.birthplace)
        birthday = str(self.artist) + "'s " + "Birthday: " + str(self.birthday)
        return [birthplace, birthday]

class Artist(models.Model):
    song = models.CharField(max_length=255, primary_key=True)
    artist = models.ForeignKey(Biography, on_delete=models.CASCADE, related_name='+')
    genre = models.CharField(max_length=255)
    album = models.CharField(max_length=255)

    def __str__(self):
        return str(self.song)

class Rating(models.Model):
    username = models.ForeignKey(User, on_delete=models.CASCADE)
    song = models.ForeignKey(Artist, on_delete=models.CASCADE)
    rating = models.IntegerField(default=0)

    def __str__(self):
        return str(self.song) + " --> " + str(self.rating) 


