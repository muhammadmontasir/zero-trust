import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
    selector: 'app-upload',
    standalone: true,
    templateUrl: './upload.component.html'
})

export class UploadComponent {
    selectedFile: File | null = null;
    message = '';

    constructor(private http: HttpClient) { }

    onFileSelected(event: any) {
        this.selectedFile = event.target.files[0];
    }

    uploadCSV() {
        if (!this.selectedFile) return;

        const formData = new FormData();
        formData.append('file', this.selectedFile);

        this.http.post('http://localhost:8081/api/upload.php', formData).subscribe({
            next: () => this.message = 'Upload successful',
            error: () => this.message = 'Upload failed.'
        })
    }
}