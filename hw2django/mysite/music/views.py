from django.shortcuts import render
from django.http import HttpResponse, HttpResponseRedirect
from django.urls import reverse
from .models import User,Artist,Rating

# Create your views here.
def index(request):
    user_rating = Rating.objects.all()
    input_user = request.POST.get('Username')
    queried = Rating.objects.all().filter(username = input_user)
    return render(request,"music/index.html",
        {'user_rating':user_rating,
        'input_user':input_user,
        'queried':queried})

def registration(request):
    try:
        username = request.POST['username']
        password = request.POST['password']
        register_button = request.POST.get('register')
    except KeyError:
        context = {
            'error_message': "Please fully complete the form.",
            'register_button': register_button,
        }
        return render(request, "music/registration.html", context)
    else:
        user = User()
        user.username = username
        user.password = password
        user.save()

        return HttpResponseRedirect(reverse('music:index'))