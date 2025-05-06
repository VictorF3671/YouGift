import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule ],
})

export class HomePage {
  constructor(private router: Router) {}

  gifts = [
    { name: 'Amazon Gift Card', description: 'Use em produtos da Amazon.' },
    { name: 'Google Play Gift Card', description: 'Para comprar apps na Play Store.' },
    { name: 'Apple Store Gift Card', description: 'Use na App Store ou iTunes.' }
  ];

  filtrar(event: any) {
    const valor = event.target.value?.toLowerCase() || '';
    console.log('Filtrando:', valor);
  }
  userProfile() {
    this.router.navigate(['/profile']);  // Navegue para a página de perfil
  }
}

 
