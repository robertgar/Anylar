import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule, NoopAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { MatButtonModule, MatRadioModule, MatIconModule, 
  MatCardModule, MatToolbarModule, MatInputModule } from '@angular/material';
import 'hammerjs';

import { routing } from './app-routing.module';

import { AuthGuard } from './_guards/auth.guard';

import { AuthenticationService } from './_services/authentication.service';

import { AppComponent } from './_components/app.component';
import { LoginComponent } from './_components/auth/login/login.component';
import { RegisterComponent } from './_components/auth/register/register.component';
import { NavigationComponent } from './_components/navigation/navigation.component';
import { HomeComponent } from './_components/home/home.component';
import { FavoritesComponent } from './_components/favorites/favorites.component';
import { NotesComponent } from './_components/notes/notes.component';
import { RocketsListComponent } from './_components/rockets-list/rockets-list.component';
import { RocketComponent } from './_components/rockets-list/rocket/rocket.component';
import { NoteComponent } from './_components/notes/note/note.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    NavigationComponent,
    HomeComponent,
    FavoritesComponent,
    NotesComponent,
    RocketsListComponent,
    RocketComponent,
    NoteComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    routing,
    HttpModule,
    BrowserAnimationsModule,
    NoopAnimationsModule,
    MatButtonModule, 
    MatRadioModule,
    MatIconModule, 
    MatCardModule,
    MatToolbarModule,
    MatInputModule
  ],
  providers: [
    AuthGuard,
    AuthenticationService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
