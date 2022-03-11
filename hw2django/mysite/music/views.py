from django.shortcuts import render
from django.http import HttpResponse, HttpResponseRedirect
from django.urls import reverse
from .models import Biography, User,Artist,Rating

# Create your views here.
def index(request):
    input_user = request.GET.get('Username')
    input_artist = request.GET.get('Artist')
    submit_username_button = request.GET.get('Submit_Username')
    submit_artist_button = request.GET.get('Submit_Artist')

    if submit_username_button:
        if not User.objects.all().filter(username=input_user):
            context = {
                'message': "The user you specified does not exist.",
                'submit_username_button': submit_username_button,
            }
            return render(request, "music/index.html", context)

        query = Rating.objects.all().filter(username = input_user)
        return render(request,"music/index.html", {'query': query})

    if submit_artist_button:
        if not Artist.objects.all().filter(artist=input_artist):
            context = {
                'message': "The artist you specified has not been rated yet. Be the first! Click on Register below!",
                'submit_artist_button': submit_artist_button,
            }
            return render(request, "music/index.html", context)

        query = Biography.objects.get(artist = input_artist).print_facts()
        context = {
            'query': query,
        }
        return render(request, "music/index.html", context)

    return render(None, "music/index.html")


def registration(request):
    register_button = request.POST.get('register')
    entered_username = request.POST.get('username')
    entered_password = request.POST.get('password')

    if not entered_username or not entered_password:
        context = {
            'error_message': "Please fully complete the form.",
            'register_button': register_button,
        }
        return render(request, "music/registration.html", context)

    if User.objects.get(username=entered_username):
        context = {
            'error_message': "The username you provided is already taken. Please try again.",
            'register_button': register_button,
        }
        return render(request, "music/registration.html", context)

    user = User()
    user.username = entered_username
    user.password = entered_password
    user.save()

    return HttpResponseRedirect(reverse('music:index'))

