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
  constructor(private router: Router, private axiosContext: AxiosContextService) {}

  ngOnInit() {
    this.carregarGifts();
  }

  carregarGifts() {
    // const response = this.axios.get('/giftcards')
    // this.giftcards = response

    
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
