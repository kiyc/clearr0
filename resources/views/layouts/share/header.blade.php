<form method="POST" action="{{ route('logout') }}" accept-charset="UTF-8" name="logout" class="hidden-xs-up">
    {{ csrf_field() }}
</form>
<v-toolbar color="primary" dark>
    <v-spacer></v-spacer>
    <v-toolbar-items class="hidden-sm-and-down">
        <v-btn flat onclick="document.logout.submit()">Logout</v-btn>
    </v-toolbar-items>
</v-toolbar>
