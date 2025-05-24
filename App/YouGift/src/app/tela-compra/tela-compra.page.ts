import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AxiosContextService } from 'src/server/axiosContext.server';
import axios from 'axios';
import { IGiftCard } from '../home/IGiftCardHome';

@Component({
  selector: 'app-tela-compra',
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule],
  templateUrl: './tela-compra.page.html',
  styleUrls: ['./tela-compra.page.scss'],
})
export class TelaCompraPage {
 gift: IGiftCard = {
  id: 0,
  name: '',
  desc: '',
  image_url: '',
  company: ''
};
values_gifts: any = {};

  valorSelecionado = 50;
  quantity = 1;

  constructor(private route: ActivatedRoute, private routerN: Router, private axiosContext: AxiosContextService) {}
  private axios = this.axiosContext.getAxiosInstance();

  ngOnInit() {
    const idParam = this.route.snapshot.paramMap.get('id');
    const id = Number(idParam);
    this.carregarGifts(id);
    this.carregarValues(id)
  }

 async carregarGifts(id: number) {
  try {
    const response = await this.axios.get(`/giftcards/${id}`);
    this.gift = response.data;
  } catch (error) {
    console.error('Erro ao carregar gift:', error);
  }
}
async carregarValues(id:number){
  try {
    const response = await this.axios.get(`/giftcard-values/${id}`);
    console.log(response.data)
    this.values_gifts = Array.isArray(response.data) ? response.data : [response.data];
    console.log('valores carregado:', this.values_gifts);
  } catch(error) {
    console.error('Erro ao carregar valores:', error);
    this.values_gifts = [];
  }
}

  selecionarValor(amount: number) {
    this.valorSelecionado = amount;
  }

  increase() {
    this.quantity++;
  }

  decrease() {
    if (this.quantity > 1) this.quantity--;
  }

  adicionarCarrinho() {
    console.log('Adicionado ao Carrinho:', this.gift.name, this.valorSelecionado, this.quantity);
    //usar TOAST 
  }

  buyNow() {
    console.log('Comprando:', this.gift.name, this.valorSelecionado, this.quantity);
    this.routerN.navigate(['/tela-pagamento']);
  }
  
  navegarHome() {
    this.routerN.navigate(['/home']);
  }
}
