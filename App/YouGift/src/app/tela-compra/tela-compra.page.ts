import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AxiosContextService } from 'src/server/axiosContext.server';
import { CompraService } from '../services/compra.service';
import { IGiftCard } from '../home/IGiftCardHome';
import { GiftTransferService } from '../services/gift-transfer.service';

export interface ICompra{
  nome: string,
  id_company: number;
  id_value: number;
  value: number;
  quantidade: number;
  valorTotal: number
}

@Component({
  selector: 'app-tela-compra',
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule],
  templateUrl: './tela-compra.page.html',
  styleUrls: ['./tela-compra.page.scss'],
})



export class TelaCompraPage {
 
 
  compra: ICompra = {
    nome: '',
    id_company: 0,
    id_value: 0,
    value: 0,
    quantidade: 1,
    valorTotal: 0
  };

  gift: IGiftCard = {
  id: 0,
  name: '',
  desc: '',
  image_url: '',
  company: ''
};

values_gifts: any[] = [];

  valorSelecionado = 50;
  quantity = 1;
 mockedValues = [
    { id: 1, value: 25 },
    { id: 2, value: 50 },
    { id: 3, value: 100 },
  ];

  constructor(private route: ActivatedRoute, private routerN: Router, private axiosContext: AxiosContextService,  private compraContext: CompraService, private giftTransfer: GiftTransferService) {}
  private axios = this.axiosContext.getAxiosInstance();

  ngOnInit() {
    const giftFromService = this.giftTransfer.getGift();
    console.log(giftFromService)
    if (giftFromService && giftFromService.id) {
      this.gift = giftFromService;
      this.carregarValues(giftFromService.id);
    } else {
      //se voltar, apaga isso de cima e deixa só esses aqui em baixo
      const idParam = this.route.snapshot.paramMap.get('id');
      const id = Number(idParam);
      this.carregarGifts(id);
      this.carregarValues(id);
    }
  
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
      console.warn('API falhou, usando valores mockados.');
      this.values_gifts = this.mockedValues;
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

  //quantidade
  //id Value
  //Value para fazer o calculo
  //id do gift
  buyNow() {
  const valueGift = this.values_gifts.find(v => Number(v.value) === Number(this.valorSelecionado));

  if (!valueGift) {
    console.error('Valor selecionado não encontrado nos valores disponíveis.');
    return;
  }

  this.compra = {
    nome: this.gift.name,
    id_company: this.gift.id, 
    id_value: valueGift.id,
    value: parseFloat(valueGift.value),
    quantidade: this.quantity,
    valorTotal: parseFloat(valueGift.value) * this.quantity
  };

  console.log('Compra gerada:', this.compra);

  // Salva no contexto para usar na próxima tela
  this.compraContext.setCompra(this.compra);

  // Navega para a tela de pagamento
  this.routerN.navigate(['/tela-pagamento']);
}

  
  navegarHome() {
    this.compraContext.clear()
    this.giftTransfer.clear()
    this.routerN.navigate(['/home']);
  }
}
