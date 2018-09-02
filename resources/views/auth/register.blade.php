@extends('layouts.app')

@section('content')
<v-container fluid fill-height>
    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                    <v-toolbar-title>Register form</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <v-card-text>
                        <v-text-field prepend-icon="person" name="name" label="Name" type="text"></v-text-field>
                        <v-text-field prepend-icon="email" name="email" label="Email" type="email"></v-text-field>
                        <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password"></v-text-field>
                        <v-text-field id="password-confirm" prepend-icon="lock" name="password_confirmation" label="Password confirm" type="password"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" color="primary">Register</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-flex>
    </v-layout>
</v-container>
@endsection
