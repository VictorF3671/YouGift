import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { AxiosContextService } from 'src/server/axiosContext.server';
import { IGiftCard } from './IGiftCardHome';
import { GiftTransferService } from '../services/gift-transfer.service';
@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule],
})

export class HomePage implements OnInit {
  constructor(private router: Router, private axiosContext: AxiosContextService, private giftTransfer: GiftTransferService,) { }
  private axios = this.axiosContext.getAxiosInstance();
  mostrarMenu = false;
  eventoDoBotao: any;
  isAdmin = false;
  giftcards: IGiftCard[] = [];

  ngOnInit() {
    const role = localStorage.getItem('role');
    console.log(role)
    //this.isAdmin = role === 'ROLE_ADMIN';
    this.isAdmin = true;
    this.carregarGifts()
  }

  async carregarGifts() {
    try {
      const response = await this.axios.get('/giftcard-produtos');
      this.giftcards = response.data;
    } catch (error) {
      console.error('Erro ao carregar gift cards. Usando dados mockados.', error);
      // Mock de gift cards
      this.giftcards = [
        {
          id: 1,
          name: 'Steam',
          desc: 'Plataforma de jogos online para PC',
          image_url: 'https://www.mygiftcardsupply.com/wp-content/uploads/2022/01/buy-steam-gift-card-online.png',
          company: 'Steam Inc.'
        },
        {
          id: 2,
          name: 'Amazon',
          desc: 'Vale-presente para compras na Amazon',
          image_url: 'https://www.mygiftcardsupply.com/wp-content/uploads/2022/01/amazon-gift-card.png',
          company: 'Amazon.com, Inc.'
        },
        {
          id: 3,
          name: 'PlayStation (PSN)',
          desc: 'Créditos para jogos e assinaturas na PSN',
          image_url: 'https://www.mygiftcardsupply.com/wp-content/uploads/2022/02/PSN-Gift-Card.png',
          company: 'Sony Interactive Entertainment'
        },
        {
          id: 4,
          name: 'Paramount+',
          desc: 'Assista séries e filmes no Paramount+',
          image_url: 'https://www.mygiftcardsupply.com/wp-content/uploads/2019/05/Paramont-Plus-Gift-Card-02.png',
          company: 'Paramount Global'
        },
        {
          id: 5,
          name: 'Razer Gold',
          desc: 'Créditos para jogos e conteúdos digitais',
          image_url: 'https://www.mygiftcardsupply.com/wp-content/uploads/2022/01/Razer-gold-gift-card-online.png',
          company: 'Razer Inc.'
        },
        {
          id: 6,
          name: 'Spotify',
          desc: 'Assinatura de música sem anúncios',
          image_url: 'https://www.mygiftcardsupply.com/wp-content/uploads/2022/01/us-spotify-gift-card-351x241.png',
          company: 'Spotify AB'
        }
      ];
    }
  }

  irCadastro() {
    this.router.navigate(['/cadastrar-gift']);
  }

  abrirDetalhe(gift: any) {
    this.giftTransfer.setGift(gift);
    this.router.navigate(['/tela-compra']);
    //caso volte a API
    //this.router.navigate(['/tela-compra', gift.id]);
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


