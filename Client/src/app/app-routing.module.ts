import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LoginComponent } from './_components/auth/login/login.component';
import { RegisterComponent } from './_components/auth/register/register.component';
import { HomeComponent } from './_components/home/home.component';
import { FavoritesComponent } from './_components/favorites/favorites.component';
import { NotesComponent } from './_components/notes/notes.component';
import { AuthGuard } from './_guards/auth.guard';

const appRoutes: Routes = [
    { path: 'login', component: LoginComponent },
    { path: 'register', component: RegisterComponent },
    { path: 'home', component: HomeComponent, canActivate: [AuthGuard]  },
    { path: 'favorites', component: FavoritesComponent, canActivate: [AuthGuard]  },
    { path: 'notes', component: NotesComponent, canActivate: [AuthGuard]  },
    // otherwise redirect to home
    { path: '**', redirectTo: 'home' }
];

export const routing = RouterModule.forRoot(appRoutes);