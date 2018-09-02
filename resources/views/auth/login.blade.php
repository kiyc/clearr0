@extends('layouts.app')

@section('content')
<v-container fluid fill-height>
    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                    <v-toolbar-title>Login form</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <v-card-text>
                        <v-text-field append-icon="person" name="email" label="Login" type="email"></v-text-field>
                        <v-text-field id="password" append-icon="lock" name="password" label="Password" type="password"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" color="primary">Login</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-flex>
    </v-layout>
</v-container>
@endsection
