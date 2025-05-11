import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonContent, IonHeader, IonTitle, IonToolbar } from '@ionic/angular/standalone';

@Component({
  selector: 'app-cadastrar-gift',
  templateUrl: './cadastrar-gift.page.html',
  styleUrls: ['./cadastrar-gift.page.scss'],
  standalone: true,
  imports: [IonContent, IonHeader, IonTitle, IonToolbar, CommonModule, FormsModule]
})
export class CadastrarGiftPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
