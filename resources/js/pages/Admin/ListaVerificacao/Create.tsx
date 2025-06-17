import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Create({ cartaos }) {
    const { data, setData, post, processing, errors } = useForm({
        it_id_cartao: '',
        vc_nome: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.listas_verificacaos.store'));
    };

    return (
        <AdminLayout title="Criar Lista de Verificação">
            <Head title="Criar Lista de Verificação" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Criar Lista de Verificação</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.listas_verificacaos.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="it_id_cartao">Cartão</Label>
                            <Select
                                value={data.it_id_cartao}
                                onValueChange={(value) => setData('it_id_cartao', value)}
                            >
                                <SelectTrigger id="it_id_cartao" className={errors.it_id_cartao ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um cartão" />
                                </SelectTrigger>
                                <SelectContent>
                                    {cartaos.map((cartao) => (
                                        <SelectItem key={cartao.id} value={cartao.id.toString()}>
                                            {cartao.vc_titulo}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_cartao && <p className="text-sm text-red-500">{errors.it_id_cartao}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_nome">Nome</Label>
                            <Input
                                id="vc_nome"
                                type="text"
                                value={data.vc_nome}
                                onChange={(e) => setData('vc_nome', e.target.value)}
                                className={errors.vc_nome ? 'border-red-500' : ''}
                            />
                            {errors.vc_nome && <p className="text-sm text-red-500">{errors.vc_nome}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Criar</Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}