import { Component, Input, Output, EventEmitter } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'ycard-error',
  templateUrl: './ycard-error.component.html',
  styleUrls: ['./ycard-error.component.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule],
})
export class YCardErrorComponent {
  @Input() message: string = '';
  @Input() type: 'error' | 'success' | 'warning' = 'error';
  @Input() visible: boolean = false;
  @Output() onClose = new EventEmitter<void>();

  fechar() {
    this.onClose.emit();
  }
}