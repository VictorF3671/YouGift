import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { AxiosContextService } from 'src/server/axiosContext.server';

@Component({
  selector: 'app-historico-gift',
  standalone: true,
  templateUrl: './gifts-cadastrados.page.html',
  styleUrls: ['./gifts-cadastrados.page.scss'],
  imports: [IonicModule, CommonModule],
})
export class GiftsCadastradosPage implements OnInit {
  giftcards: any[] = [];
  private axios = this.axiosContext.getAxiosInstance();
  constructor(private router: Router, private axiosContext: AxiosContextService,) {}

  ngOnInit() {
    this.carregarGifts();
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
    name: 'PlayStation',
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
  
  irCadastrarValor() {
    this.router.navigate(['/cadastrar-valor']);
  }

  irCadastrarGift() {
    this.router.navigate(['/cadastrar-gift']);
  }

  excluirGift(id: number) {
    // if (confirm('Tem certeza que deseja excluir este gift?')) {
    //   this.http.delete(`http://sua-api.com/gifts/${id}`).subscribe(() => {
    //     this.carregarGifts(); // Recarrega a lista após exclusão
    //   });
    // }
  }
}
