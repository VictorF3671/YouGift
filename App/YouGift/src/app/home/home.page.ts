import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router'
@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule],
})

export class HomePage implements OnInit{
  constructor(private router: Router) { }
  mostrarMenu = false;
  eventoDoBotao: any;
  isAdmin = false;
  giftcards = [
    {
      nome: 'Netflix',
      descricao: 'Assista filmes e séries',
      imagem: './assets/netflix.png'
    },
    {
      nome: 'Spotify',
      descricao: 'Música ilimitada',
      imagem: './assets/spotify.png'
    },
    {
      nome: 'Free Fire',
      descricao: 'Diamantes para suas batalhas',
      imagem: './assets/freefire.png'
    },
    {
      nome: 'Roblox',
      descricao: 'Robux para customizar seu avatar',
      imagem: './assets/roblox.png'
    },
    {
      nome: 'Amazon',
      descricao: 'Compre tudo o que quiser',
      imagem: './assets/amazon.png'
    }
  ];

  ngOnInit() {
  const role = localStorage.getItem('group'); 
  console.log(role)
  this.isAdmin = role === 'admin';
  }
  

  slideOpts = {
    slidesPerView: 2.2,
    spaceBetween: 10
  };

  irCadastro() {

    this.router.navigate(['/cadastrar-gift']);
  }

  abrirDetalhe(gift: any) {

    this.router.navigate(['/tela-compra', gift.nome]);
  }

  filtrar(event: any) {
    const valor = event.target.value?.toLowerCase() || '';
    console.log('Filtrando:', valor);
  }
  userProfile() {
    this.router.navigate(['/profile']);
  }
  abrirMenu(event: any) {
    this.eventoDoBotao = event;
    this.mostrarMenu = true;
  }

  irPerfil() {
    this.mostrarMenu = false;
    this.router.navigate(['/perfil']);
  }

  irHistorico() {
    this.mostrarMenu = false;
    this.router.navigate(['/historico']);
  }

  irUsuarios() {
    this.mostrarMenu = false;
    this.router.navigate(['/usuarios']);
  }

  irGiftsCadastrados() {
    this.mostrarMenu = false;
    this.router.navigate(['/gifts-cadastrados']);
  }

  logout() {
    this.mostrarMenu = false;
    localStorage.clear();
    this.router.navigate(['/login']);
  }
}


