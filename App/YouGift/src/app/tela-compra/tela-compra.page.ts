import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-tela-compra',
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule],
  templateUrl: './tela-compra.page.html',
  styleUrls: ['./tela-compra.page.scss'],
})
export class TelaCompraPage {
  gift: any = {};
  valorSelecionado = 50;
  quantity = 1;

  constructor(private route: ActivatedRoute, private routerN: Router) {}

  ngOnInit() {
    const nome = this.route.snapshot.paramMap.get('nome');
    this.gift = {
      nome,
      imagem: './assets/' + nome?.toLowerCase() + '.png',
    };
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
    console.log('Adicionado ao Carrinho:', this.gift.nome, this.valorSelecionado, this.quantity);
    //usar TOAST 
  }

  buyNow() {
    console.log('Comprando:', this.gift.nome, this.valorSelecionado, this.quantity);
    this.routerN.navigate(['/tela-pagamento']);
  }
  
  navegarHome() {
    this.routerN.navigate(['/home']);
  }
}
