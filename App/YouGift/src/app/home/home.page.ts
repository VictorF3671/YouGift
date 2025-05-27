import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { AxiosContextService } from 'src/server/axiosContext.server';
import { IGiftCard } from './IGiftCardHome';
@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule],
})

export class HomePage implements OnInit{
  constructor(private router: Router,  private axiosContext: AxiosContextService) { }
  private axios = this.axiosContext.getAxiosInstance();
  mostrarMenu = false;
  eventoDoBotao: any;
  isAdmin = false;
  giftcards: IGiftCard[] = [];

  ngOnInit() {
  const role = localStorage.getItem('group'); 
  console.log(role)
  this.isAdmin = role === 'admin';
  this.carregarGifts()
  }

  async carregarGifts(){
    const response = await this.axios.get('/giftcards')
    this.giftcards = response.data;
  }

  irCadastro() {
    this.router.navigate(['/cadastrar-gift']);
  }

  abrirDetalhe(gift: any) {
    this.router.navigate(['/tela-compra', gift.id]);
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
    this.router.navigate(['/usuarios-cadastrados']);
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


